<template>
    <div>
        <div v-if="loading">
            <div class="container py-2">
                <h2>{{ apartment.title }}</h2>
                <p>{{ apartment.address }}</p>
                <div class="row m-0">
                    <img :src="apartment.cover" class="border-rd opacity" width="100%" height="500px" alt="">
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

.border-rd {
    border-radius: 12px;
    cursor: pointer;
}

.opacity:hover {
    filter: contrast(80%);
    transition: all 0.3s ease-in-out;
}

</style>