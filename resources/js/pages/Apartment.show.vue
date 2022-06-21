<template>
    <div>
        <div v-if="loading">
            <div class="container py-2">
                <h2>{{ apartment.title }}</h2>
                <p>{{ apartment.address }}</p>
                <div class="row m-0">
                    <img :src="apartment.cover" class="border-rd opacity" width="100%" height="500px" alt="">
                </div>
                <div class="mt-4 d-flex flex-column gap-bg">
                    <h3 class="mb-3">Informazioni appartmento:</h3>
                    <p class="m-0">Numero di stanze: {{ apartment.number_of_room }}</p>
                    <p class="m-0">Numero di letti: {{ apartment.number_of_bedroom }}</p>
                    <p class="m-0">Numero di bagni: {{ apartment.number_of_bathroom }}</p>
                    <p class="m-0">Metri quadri: {{ apartment.sqm }}</p>
                    <p class="m-0">Media recensioni: {{ vote[random()].rec}}</p>
                </div>
                <div class="mt-4 ">
                    <h4 class="mb-3">Servizi Aggiuntivi:</h4>
                    <ul class="p-0">
                        <li v-for="el in apartment.adds" :key="el.id">{{ el.name }}</li>
                    </ul>
                </div>
            </div>

            <div>
               <form id="message-form" @submit.prevent="sendMessage">
                    <div class="form-group">
                        <label class="required-field">Name</label>
                        <input type="text" class="form-control my_form" id="text" v-model="form.text" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label class="required-field">Email address</label>
                        <input type="email" class="form-control my_form" id="email" v-model="form.email" placeholder="Name@example.com" required>
                    </div>
                    
                    <button class="btn btn-dark" type="submit">
                            <span v-if="success == null || success == true">Send</span>
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
                { id: 1, rec: '4.88'},
                { id: 2, rec: '5.00'},
                { id: 3, rec: '4.70'},
                { id: 4, rec: '4.50'},
                { id: 5, rec: '4.20'},
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

ul {
    list-style: none;
}

.border-rd {
    border-radius: 12px;
    cursor: pointer;
}

.opacity:hover {
    filter: contrast(80%);
    transition: all 0.3s ease-in-out;
}

.gap-bg {
    gap: 15px;
}

</style>