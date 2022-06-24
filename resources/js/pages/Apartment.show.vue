<template>
    <div>
        <div v-if="loading">
            <div class="container py-2">
                <h2 class="title">{{ apartment.title }}</h2>
                <div class="d-flex">
                    <p class="m-0">&#9733; {{ vote[random()].rec}}</p>
                    <p class="m-0 pl-3 text-gl">{{ vote[random()].num}} recensioni</p>
                    <p class="m-0 pl-3">Superhost</p>
                    <p class="pl-3 text-gl-2">{{ apartment.address }}</p>
                </div>
                <div class="row m-0">
                    <img :src="apartment.cover" class="border-rd opacity" width="100%" height="500px" alt="">
                </div>
                <div class="mt-4 d-flex flex-column gap-bg after-gl">
                    <h3 class="mb-3 mt-3 tex">Informazioni appartmento:</h3>
                    <div class="m-0 p-0 title-gl d-flex">Numero di stanze: 
                        <p class="descr-gl">&nbsp;{{ apartment.number_of_room }}</p>
                    </div>
                    <div class="m-0 title-gl d-flex">Numero di letti: 
                        <p class="descr-gl">&nbsp;{{ apartment.number_of_bedroom }}</p>
                    </div>
                    <div class="m-0 title-gl d-flex">Numero di bagni: 
                        <p class="descr-gl">&nbsp;{{ apartment.number_of_bathroom }}</p>
                    </div>
                    <div class="m-0 title-gl d-flex">Metri quadri: 
                        <p class="descr-gl">&nbsp;{{ apartment.sqm }}</p>
                    </div>
                    <div class="m-0 d-flex title-gl mb-3">Prezzo:
                        <p class="m-0 price-ap">&nbsp; {{ apartment.price }} &euro; &nbsp; /notte</p>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-column gap-bg after-gl">
                    <img class="mb-3" src="https://a0.muscache.com/im/pictures/54e427bb-9cb7-4a81-94cf-78f19156faad.jpg" width="100px" height="30px" alt="">
                    <p>Ogni prenotazione include una protezione gratuita in caso di cancellazione da parte dell'host, di inesattezze dell'annuncio e di altri problemi come le difficoltà in fase di check-in.</p>
                    <p class="text-gl">Per saperne di più</p>
                </div>
                <div class="mt-4 d-flex flex-column gap-bg after-gl">
                    <p>Alcune informazioni sono state tradotte automaticamente.</p>
                    <p>{{ apartment.description }}</p>
                </div>
                <div class="mt-4 d-flex flex-column gap-bg after-gl">
                    <h4 class="mb-1 title-gl">Cosa troverai:</h4>
                    <ul class="p-0">
                        <li v-for="el in apartment.adds" :key="el.id">{{ el.name }}</li>
                    </ul>
                </div>
            </div>

            <div class="container py-4">
                <h2 class="title-gl">Invia un messaggio al proprietario dell 'appartamento per ulteriori informazioni</h2>
               <form id="message-form" @submit.prevent="sendMessage">
                    <div class="form-group">
                        <label class="required-field">Email:</label>
                        <input type="email" class="form-control my_form" id="email" v-model="form.email" required>
                    </div>
                    <div class="form-group">
                        <label class="required-field">Descrizione:</label>
                        <textarea class="form-control my_form" id="text" v-model="form.text" placeholder="" required></textarea>
                    </div>
                    
                    <button class="btn bg-it text-white" type="submit">
                            <span v-if="success == null || success == true">Invia</span>
                        <div v-if="success == false" class="spinner-border" role="status">
                        </div>
                    </button>
                </form>
            </div>

        </div>

        <LoadingWheel v-else />

    </div>
</template>

<script>

import LoadingWheel from '../components/LoadingWheel.vue'
import axios from "axios";

export default {
    components: {
        LoadingWheel,
    },
    data() {
        return {
            apartment: [],
            loading: false,
            success: null,
            vote: [
                { id: 1, rec: '4.88', num: '20'},
                { id: 2, rec: '5.00', num: '25'},
                { id: 3, rec: '4.70', num: '50'},
                { id: 4, rec: '4.50', num: '10'},
                { id: 5, rec: '4.20', num: '37'},
            ],
             form: {
                email: "",
                text: "",
            }
        };
    },
    methods: {
        fetchApartment() {
            axios
                .get(`/api/apartment/${this.$route.params.slug}`)
                .then((res) => {
                    const { apartment } = res.data;
                    this.apartment = apartment;
                    console.log(this.apartment)
                    this.loading = true;
                })
                .catch((err) => {
                    console.warn(err);
                    this.$router.push("/404");
                });
        },
        random: function () {
            return Math.floor(Math.random()*5);
        },
        sendMessage() {
            this.success = false
            axios.post(`/api/messages`, {
                'apartment_id': this.apartment.id,
                'email': this.form.email,
                'text': this.form.text
            })
            .then(response => {
                if(response.data.success === true){
                    this.success = true
                    this.form.email = ''
                    this.form.text = ''
                    setTimeout(() => {
                        this.success = null;
                    },5000)
                }
            });
        }
    },
    mounted() {
        this.fetchApartment();
    },
}

</script>

<style lang="scss" scoped>

.text-gl {
    text-decoration: underline;
    font-weight: 600;
}

.descr-gl {
    font-weight: 500;
}

.price-ap {
    font-weight: 500;
}

.after-gl::after {
    content: '';
    display: block;
    width: 100%;
    height: 1px;
    background-color: lightgray;
}

.tex {
    font-weight: 700;
    font-size: 25px;
}

.title-gl {
    font-weight: 600;
}

.text-gl-2 {
    font-weight: 600;
}

.title {
    font-weight: 700;
    font-size: 35px;
}

ul {
    list-style: none;
}

.border-rd {
    border-radius: 12px;
    cursor: pointer;
}

.opacity:hover {
    filter: contrast(90%);
    transition: all 0.3s ease-in-out;
}

.bg-it {
    background-color: #ff385c;
}

</style>