<template>
    <div>
        <b-media :right-align="writtenByMe" vertical-align="center" class="mb-2">
            <template v-slot:aside>
                <b-img rounded="circle" :src="image" width="48" alt="placeholder"></b-img>
            </template>
            <b-card >
                <slot></slot>
            </b-card>
        </b-media>
    </div>
</template>

<script>
export default {
        props: {
            writtenByMe: Boolean,
            image: String
        },
        data(){
            return{
        
            };
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>