<template>
    <button
        class="btn btn-default pull-left"
        v-text="text"
        v-bind:class="{'btn-primary pull-left':voted}"
        v-on:click="vote"

    ></button>
</template>

<script>
    export default {
        props:['answer','count'],
        mounted() {
            axios.post('/api/answer/'+this.answer+'/votes/users').then(response=>{
//                console.log(response.data);
                this.voted = response.data.voted;
            })

        },
        data(){
          return{
              voted:false,
              vote_count:this.count

          }
        },
        computed:{
            text(){
                return this.vote_count;
            }
        },
        methods:{
            vote(){
                axios.post('/api/answer/vote',{'answer':this.answer}).then(response=>{
                console.log(response.data.voted);
                    this.voted = response.data.voted;
                    response.data.voted ? this.vote_count++ : this.vote_count--;
                })
            }
        }
    }
</script>

