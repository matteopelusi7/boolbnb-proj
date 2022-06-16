<template>
    <div>
        <div v-if="loading">
            <div class="container py-2">
                <div class="row">
                    <ul class="d-flex flex-wrap p-0 list-wrap">
                        <router-link tag="li" v-for="user in users" :key="user.id" class="col-4 d-flex flex-column gap-bg" :to="{ name: 'apartment.show', params: { slug: user.slug },}">
                            <div v-for="apartments in user.apartments" :key="apartments.id" class="card overflow-hidden border-rd cursor-pointer">
                                <img :src="apartments.cover" height="200" alt="">
                                <div class="card-footer bg-white p-1">
                                    <div>
                                        <p class="p-0">{{ apartments.title }}</p>
                                        <p class="p-0">{{ apartments.address }}</p>
                                        <p class="p-0">{{ apartments.sqm }}</p>
                                        <p class="p-0">Di: {{ user.name }} {{ user.surname }}</p>
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </ul>
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
            loading: false,
        };
    },
    methods: {
        fetchUsers() {
            axios
                .get("/api/home")
                .then((res) => {
                    const { users } = res.data;
                    this.users = users;
                    console.log(this.users)
                    this.loading = true;
                })
                .catch((err) => {
                    console.warn(err);
                    this.$router.push("/404");
                });
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
    border-radius: 8px;
}

.list-wrap {
    gap: 20px 0px;
}

.card {
    border: none;
}

.gap-bg {
    gap: 20px 0;
}

</style>