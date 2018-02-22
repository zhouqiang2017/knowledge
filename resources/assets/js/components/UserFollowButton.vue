<template>
    <button
        class="btn btn-default pull-left"
        v-text="text"
        v-bind:class="{'btn-success pull-left':followed}"
        v-on:click="follow"

    ></button>
</template>

<script>
    export default {
        props:['user'],
        mounted() {
            axios.get('/api/user/followers/'+this.user).then(response=>{
//                console.log(response.data);
                this.followed = response.data.followed;
            })

        },
        data(){
          return{
              followed:false
          }
        },
        computed:{
            text(){
                return this.followed? '已关注':'关注他'
            }
        },
        methods:{
            follow(){
                axios.post('/api/user/follow',{'user':this.user}).then(response=>{
//                console.log(response.data);
                    this.followed = response.data.followed;
                })
            }
        }
    }
</script>
