<template>
    <div>
        <button
                class="btn btn-default pull-right"
                @click="showSendMessageForm"

        >发送私信
        </button>

        <div class="modal fade" id="modal-send-message" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            发送私信
                        </h4>
                    </div>

                    <div class="modal-body">
                        <textarea name="body" class="form-control" v-model="body" v-if="!status"></textarea>
                        <div class="alert alert-succss" v-if="status">
                            <strong>私信发送成功</strong>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" @click="store">
                            发送私信
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                body: '',
                status: false
            }
        },
        methods: {
            store() {
                axios.post('/api/message/store', {'user': this.user, 'body': this.body}).then(response => {
                    this.status = response.data.status;
                    this.body = '';
                    setTimeout(function () {
                    $('#modal-send-message').modal('hide');
                    },3000);
                    this.status = false;
                })
            },
            showSendMessageForm() {
                $('#modal-send-message').modal('show');
            }
        }
    }
</script>

