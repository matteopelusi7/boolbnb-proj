<template>
    <div class="py-40 d-flex flex-column justify-content-center align-items-center">
        <h1>404</h1>
        <p>Pagina non trovata</p>
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                <button class=" btn-home btn  rounded-pill">
                    <a href="/">Torna alla Home</a>
                </button>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>

.btn-home{
        background-color: #ff385c;
        color:white;
        font-weight: 700;
        text-decoration: none;
        margin-bottom: 50px;
    &:hover{
        background-color: #fc1b45;
        color: white;
    }
    a{
        text-decoration: none;
        color:currentColor;
    }
}

</style>