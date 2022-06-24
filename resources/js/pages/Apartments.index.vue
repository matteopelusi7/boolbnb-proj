<template>
    <div>
        <div v-if="loading">
            <div class="container py-2">
                <h2 class="text-center pb-5 font-title">Appartamenti vicino a te</h2>
                <div class="row">
                    <ul class="d-flex flex-wrap p-0 list-wrap">
                        <router-link tag="li" v-if="user.visible == 1" v-for="user in users" :key="user.id" class="cursor-pointer col-12 col-md-6 col-lg-4 d-flex flex-column gap-bg" :to="{ name: 'apartment.show', params: { slug: user.slug },}">
                            <img class="border-rd" :src="user.cover" height="200" alt="">
                            <div class="card-footer bg-white p-1 d-flex justify-content-between">
                                <div class="pt-1">
                                    <p class="m-0 title-ap">{{ user.title }}</p>
                                    <p class="m-0 address-ap">{{ user.address }}</p>
                                    <p class="m-0 sqm-ap">{{ user.sqm }}</p>
                                    <div class="m-0 d-flex">
                                        <p class="m-0 price-ap">{{ user.price }} &euro; &nbsp;</p>
                                       /notte
                                    </div>
                                </div>
                                <div class="pt-1">
                                    <p class="rec">{{ vote[random()].rec}} &#9733;</p>
                                </div>
                            </div>
                        </router-link>
                    </ul>
                    <div class="container py-4">
                        <ul class="pagination d-flex justify-content-center gap-3 align-item-center">
                            <li @click="fetchUsers(n)" :class="currentPage === n ? 'bg-gl1' : 'bg-gl2'" class="d-flex justify-content-center align-items-center cursor-pointer rounded-circle pagination-button" v-for="n in lastPage" :key="n">
                                {{ n }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <h2 class="text-center pt-5 font-title">Ricerca Avanzata</h2>
                    <p class="text-center pb-5">Vai alla pagina di ricerva avanzata</p>
                    <div class="d-flex justify-content-center">
                        <router-link
                            tag="a"
                            :to="{
                                name: 'filter-page',
                            }"
                            class="cursor-pointer search rounded-pill"
                        >
                            Vai!
                        </router-link>
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
            users: [],
            lastPage: 0,
            currentPage: 1,
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
                .get("/api/home", {
                    params: {
                    page
                }
                })
                .then((res) => {
                    const { users } = res.data
                    const {data, last_page, current_page} = users
                    this.users = data
                    this.currentPage = current_page
                    this.lastPage = last_page
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
    },
    mounted() {
        this.fetchUsers();
    },
}

</script>

<style lang="scss">

ul {
    list-style: none;
}

.border-rd {
    border-radius: 12px;
}

.list-wrap {
    gap: 20px 0px;
}

.card {
    border: none;
}

.gap-bg {
    cursor: pointer;
}

.font-title {
    font-size: 35px;
    font-weight: 800;
}

.search {
    color: currentColor;
    text-decoration: none;
    text-align: center;
    font-size: 20px;
    background-color: #ff385c;
    color: white;
    padding: 5px 30px;
}

.card-footer {
    gap: 10px;
}

.title-ap {
    font-weight: 700;
    font-size: 15px;
}

.rec {
    font-weight: 600;
}

.address-ap, .sqm-ap {
    color: #797187;
}

.pagination {
    gap: 20px;
}

.pagination-button {
    cursor: pointer;
    padding: 10px 15px;
}

.bg-gl1 {
  background-color: #fc1b45;
  color: white;
}

.bg-gl2 {
  background-color: #fd627e;
  color: white;
}

a:hover {
    text-decoration: none;
    color: white;
}

.price-ap {
    font-weight: 800;
}

</style>