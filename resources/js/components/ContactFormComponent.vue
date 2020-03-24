<template>
    <b-form class=" my-3 mx-2">
        <b-form-input
        class="text-center"
        type="text"
        placeholder="Buscar Contacto..."
        v-model="querySearch"
        >
        </b-form-input>
    </b-form>
</template>

<script>
export default {
    computed:{
        querySearch: {
            get(){
                return this.$store.state.querySearch;
            },
            set (value){
                this.$store.commit('newQuerySearch', value);
            }
        }
    }
}
</script>