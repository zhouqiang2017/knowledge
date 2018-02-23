<template>
    <div>
        <button
                class="btn is_naked delete-btn pull-right"
                @click="showCommentsForm"
                v-text="text"

        >
        </button>

        <div class="modal fade" :id="dialog" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            评论列表
                        </h4>
                    </div>

                    <div class="modal-body">
                        <div v-if="comments.length > 0">
                            <div class="media" v-for="comment in comments">
                                <div class="media-left">
                                    <a href="#">
                                        <img width="20" class="media-object" :src="comment.user.avatar" alt="comment.user.name">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{comment.user.name}}</h4>
                                    {{comment.body}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <input type="text" v-model="body" class="form-control">
                        <button type="button" class="btn btn-primary" @click="store">
                            评论
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    export default {
        props: ['type', 'model', 'count'],
        data() {
            return {
                body: '',
                comments: [],
                newComment:{
                    user:{
                        name:know.name,
                        avatar:know.avatar
                    },
                    body:''
                },
            }
        },
        computed: {
            dialog() {
                return 'comment-dialog-' + this.type + this.model;
            },
            dialogId() {
                return '#' + this.dialog;
            },
            text() {
                return this.count + '评论'
            }
        },
        methods: {
            store() {
                axios.post('/api/comment', {
                    'type': this.type,
                    'model': this.model,
                    'body': this.body
                }).then(response => {
                    this.newComment.body = response.data.body;
                    this.comments.push(this.newComment);
                    this.body = '';
                    this.count++
//                    console.log(response.data)
                })
            },
            showCommentsForm() {
                this.getComments();
                $(this.dialogId).modal('show');
            },
            getComments() {
                axios.get('/api/' + this.type + '/' + this.model + '/comments').then(response => {
                    this.comments = response.data;
                })
            }
        }
    }
</script>

