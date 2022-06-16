<template>
    <div>
        <div v-if="loading">
            <div class="container py-2">
                <div class="row">
                    <ul class="d-flex flex-wrap p-0 list-wrap">
                        <li v-for="el in apartment" :key="el.id">
                            <img :src="el.cover" alt="">
                        </li>
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
            apartment: [],
            loading: false,
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
    },
    mounted() {
        this.fetchApartment();
    },
}

</script>

<style lang="scss" scoped>



</style>