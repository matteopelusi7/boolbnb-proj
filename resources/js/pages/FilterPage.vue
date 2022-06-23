<template>
    <div>
        <div v-if="loading">
            <div class="container py-2">
                <h1 class="mb-3 text-center title">Ricerca Appartamento</h1>
                <h5 class="text-center pt-2">Seleziona una o più servizi aggiuntivi disponibili:</h5>
                <div class="row flex-md-row flex-column">
                    <div class="col-12 col-md-2">
                        <form class="form-inline w-100 d-flex justify-content-around">
                            <div class="form-group row">
                                <label class="col-form-label" for="add"></label>
                                <form @submit.prevent="fetchUsers" class="container my-bg-categories">
                                    <ul class="filter-list filter py-3 d-flex flex-row flex-md-column flex-wrap justify-content-center p-4">
                                        <li v-for="add in adds" :key="add.id">
                                            <input class="mx-1" type="checkbox" v-model="addFilter" @change="check()" :id="add.id" :name="add.id" :value="add.id" />
                                            <label :for="add.id" class="d-flex justify-content-between pill-color rounded-pill selected " >
                                                <span class="text-center text-md-left font-weight-bold">
                                                    {{ add.name }}
                                                </span>
                                                <span class="counter">
                                                    {{ add.apartments.length }}
                                                </span>
                                            </label>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </form>
                    </div>
                    
                    <div class="col-12 col-md-10 restaurant-wrapper">
                        <div class="restaurants-bg py-4">
                            <div class="container">
                                <div>
                                    <ul class="d-flex flex-wrap p-0 list-wrap">
                                        <router-link tag="li" v-if="user.visible == 1" v-for="user in users" :key="user.id" class="cursor-pointer col-12 col-md-6 col-lg-4 d-flex flex-column gap-bg" :to="{ name: 'apartment.show', params: { slug: user.slug },}">
                                            <img class="border-rd" :src="user.cover" height="200" alt="">
                                            <div class="card-footer bg-white p-1 d-flex justify-content-between">
                                                <div class="pt-1">
                                                    <p class="m-0 title-ap">{{ user.title }}</p>
                                                    <p class="m-0 address-ap">{{ user.address }}</p>
                                                    <p class="m-0 sqm-ap">{{ user.sqm }}</p>
                                                </div>
                                                <div class="pt-1">
                                                    <p class="rec">{{ vote[random()].rec}}</p>
                                                </div>
                                            </div>
                                        </router-link>
                                    </ul>

                                    <div class="container pt-5">
                                        <ul class="pagination flex justify-content-center align-items-center gap-4 items-center">
                                            <li @click="fetchFiltered(addFilter, n)" :class="currentPage === n ? 'bg-gl1' : 'bg-gl2'" class="d-flex justify-content-center align-items-center cursor-pointer rounded-circle pagination-button" v-for="n in lastPage" :key="n">
                                                {{ n }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            addFilter: [],
            users: [],
            adds: [],
            lastPage: 0,
            currentPage: 1,
            userAdds: [],
            loading: false,
            vote: [
                { id: 1, rec: '4.88'},
                { id: 2, rec: '5.00'},
                { id: 3, rec: '4.70'},
                { id: 4, rec: '4.50'},
                { id: 5, rec: '4.20'},
            ],
        };
    },
    methods: {
        fetchUsers(page = 1) {
            axios
                .get("/api/user", {
                params: {
                    page,
                },
            })
            .then((res) => {
                const { users } = res.data;
                const { data, last_page, current_page } = users;
                this.users = data;
                this.currentPage = current_page;
                this.lastPage = last_page;
                console.log(this.users);
                this.loading = true;
            })
            .catch((err) => {
                console.warn(err);
                this.$router.push("/404");
            });
        },
        fetchFiltered(add, page = 1) {
            axios
                .get("/api/user", {
                params: {
                    add: add,
                    page,
                },
            })
            .then((res) => {
                const { users } = res.data;
                const { data, last_page, current_page } = users;
                this.users = data;
                this.currentPage = current_page;
                this.lastPage = last_page;
                console.log(this.users);
            })
            .catch((err) => {
                console.warn(err);
                this.$router.push("/404");
            });
        },
        fetchAdds() {
            axios
                .get("/api/add")
                .then((res) => {
                const { adds } = res.data;

                this.adds = adds;
                })
            .catch((err) => {
                console.warn(err);
                this.$router.push("/404");
            });
        },
        check() {
            if (this.addFilter !== "") {
                this.fetchFiltered(this.addFilter, 1);
            } else {
                this.fetchUsers();
            }
        },
        random: function () {
            return Math.floor(Math.random()*5);
        },
    },
    created() {
        this.fetchAdds();
        this.fetchUsers();
    },
}

</script>

<style lang="scss" scoped>

ul {
    list-style: none;
}

.title {
    font-weight: 700;
}

a {
  text-decoration: none;
  color: currentColor;
}
.filter {
  display: flex;
  gap: 12px;
  list-style: none;
}

.tipologies-card {
  gap: 0 5px;
  padding: 0 10px 30px 10px;
}

.title-rest {
  font-weight: 800;
  font-size: 40px;
}

ul li input[type="checkbox"] {
  display: none;
}

.selected {
  position: relative;
  display: inline-block;
  padding: 10px 30px;
  cursor: pointer;
  width: 170px;
  border-radius: 30px;
  border:1px solid transparent;
}

input[type="checkbox"]:checked ~ label {
  padding: 10px 30px;
  background-color: #ff385c;
  color: white;
 
-webkit-box-shadow: 1px 12px 10px -5px rgba(0, 211, 168, 0.78);
box-shadow: 1px 12px 10px -5px rgba(0, 211, 168, 0.78);
}

.counter {
  background-color: #12a199;
  border-radius: 100%;
  padding: 10px 10px;
  height: 26px;
  width: 26px;
  display: flex;
  align-items: center;
  justify-content: center;
  color:white;
}

</style>