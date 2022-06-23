<template>
    <div>
        <div v-if="loading">
            <div class="container py-2">
                <h1 class="mb-3">Ricerca Appartamento</h1>
                <h5>Seleziona una o più servizi aggiuntivi disponibili:</h5>
                <div class="col-12 col-md-2">
                    <form class="form-inline w-100 d-flex justify-content-around">
                        <div class="form-group row">
                            <label class="col-form-label" for="add"></label>
                            <form @submit.prevent="fetchUsers" class="container my-bg-categories">
                                <p class="text-center text-md-left px-5">
                                    <strong>Filtri più usati</strong>
                                </p>
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
                                <ul class=" d-flex row flex-wrap justify-content-center ml-2 list-wrapper pt-3">
                                    <router-link
                                    tag="li"
                                    v-for="user in users"
                                    :key="user.id"
                                    :class="
                                        currentPage == 4 && users.length < 3
                                        ? 'cursor-pointer list-item col-12 col-sm-12 col-md-12 col-lg-6 col-xs-12'
                                        : 'cursor-pointer list-item col-12 col-md-12 col-lg-6'
                                    "
                                    :to="{
                                        name: 'apartment.show',
                                        params: { slug: user.slug },
                                    }"
                                    >
                                        <div class="card card-t rounded-mid overflow-hidden">
                                            <div class="overlay overflow-hidden">
                                                <img :src="user.cover" class="card-img-top img-card" alt="">
                                            </div>
                                            <div class="card-title d-flex align-items-center justify-content-center flex-column text-white">
                                                <h5 class="name-business text-center text-capitalize">
                                                    {{ user.title }}
                                                </h5>
                                                <div class="d-flex flex-row tipologies-card flex-wrap justify-content-center align-items-center mb-4">
                                                    <p v-for="el in user.adds" :key="el.id" class="tipologies-name badge badge-dark">
                                                    {{ el.name }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="bg-white card-foot d-flex justify-content-between align-items-center mt-2 px-2">
                                                <div class="d-flex flex-wrap">
                                                </div>
                                            <div class="d-flex flex-wrap align-items-center">
                                                <div class="d-flex mr-2">
                                                    <p class="bg-gl font-gl text-uppercase">Gratis</p>
                                                    </div>
                                                        <div class="d-flex temp-cl">
                                                    </div>
                                                </div>
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
    },
    created() {
        this.fetchAdds();
        this.fetchUsers();
    },
}

</script>

<style lang="scss" scoped>

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

.pagination {
  gap: 20px;
}

.pagination-button {
  padding: 10px 15px;
}

.bg-gl1 {
  background-color: #ffc244;
}

.bg-gl2 {
  background-color: #faeac4;
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
  background-color: #fcc244;
 
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