<template>
    <div>
        <div v-if="loading">
            <div class="container py-2">
                <h1 class="mb-3">Ricerca Appartamento</h1>
                <h5>Seleziona una o più servizi aggiuntivi disponibili:</h5>
                <form class="form-inline w-100 d-flex justify-content-around">
                    <div class="form-group row">
                        <label class="col-form-label" for="category"></label>
                        <form
                            @submit.prevent="fetchApartment"
                            class="container my-bg-categories"
                        >
                            <ul class="filter">
                                <li
                                    v-for="add in adds"
                                    :key="add.id"
                                >
                                    <input
                                        class="mx-1"
                                        type="checkbox"
                                        v-model="addFilter"
                                        @click="checkAdds"
                                        :id="add.name"
                                        :name="add.name"
                                        :value="add.name"
                                    />
                                    <label :for="add.name">
                                        {{ add.name }}
                                    </label>
                                </li>
                            </ul>
                        </form>
                    </div>
                </form>
                
                <div>
                    <!-- nessun appartamento trovato  -->
                    <div v-if="filteredApartments.length == 0">
                        <div>
                            <h2>Nessun appartamento trovato</h2>
                        </div>
                    </div>

                    <!-- appartamenti trovati  -->

                    <ul
                        v-else
                        class="d-flex flex-wrap justify-content-center gap-card"
                    >
                        <router-link
                            tag="li"
                            v-for="user in filteredUsers"
                            :key="user.id"
                            class="cursor-pointer"
                            :to="{
                                name: 'apartment.show',
                                params: { slug: user.slug },
                            }"
                        >
                            <div class="card">
                                <img v-if="user.cover" :src="user.cover" class="card-img-top" alt="" />
                                <img v-else src="https://picsum.photos/300/150" style=" width: 200px; height: 100px;" alt="">
                                <div class="card-body">
                                    <h5 class="card-title name-business text-left">
                                        {{ user.title }}
                                    </h5>

                                    <p class="card-text address-name">
                                        {{ user.address }}
                                    </p>
                                    <a href="#" class="btn bg-gl">Vedi Menù</a>
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
            addFilter: [],
            users: [],
            adds: [],
            filteredUsers: [],
            userAdds: [],
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
        fetchAdds() {
            axios
                .get("/api/add")
                .then((res) => {
                    const { adds } = res.data;
                    this.adds = adds;
                    console.log(this.adds)
                })
                .catch((err) => {
                    console.warn(err);
                    this.$router.push("/404");
                });
        },
        checkAddsContain(user) {
            let userAdds = user.adds.map((t) => {
                return t.name;
            });
            return this.addFilter.every((element) => {
                return userAdds.includes(element);
            });
        },
        checkAdds() {
            console.log(this.addFilter);
        },
    },
    created() {
        this.fetchAdds();
        this.fetchUsers();
    },
    computed: {
        filteredApartments() {
            if (!this.addFilter.length) {
                return (this.filteredUsers = this.users);
            } else {
                this.filteredUsers = this.users.filter(
                    this.checkAddsContain
                );
                return this.filteredUsers;
            }

        },
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