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
                                </div>
                                <div class="pt-1">
                                    <p class="rec">{{ vote[random()].rec}}</p>
                                </div>
                            </div>
                        </router-link>
                    </ul>
                    <div class="container py-4">
                        <ul class="pagination flex justify-center gap-4 item-center">
                            <li @click="fetchUsers(n)" :class="[ currentPage === n ? 'bg-orange-400' : 'bg-white-400', 'dot bg-white/30 rounded-full cursor-pointer h-10 w-10 flex items-center justify-center text-sm']" v-for="n in lastPage" :key="n">
                                {{ n }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h2 class="text-center pb-5 font-title">Pagina per filtrare appartamenti</h2>
                     <router-link
                        tag="a"
                        :to="{
                            name: 'filter-page',
                        }"
                        class="cursor-pointer"
                    >
                    Vai alla pagina
                    </router-link>
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

<style lang="scss" scoped>

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

</style>