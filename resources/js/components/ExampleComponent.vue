<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Users list</div>
                    <div class="card-body">
                        <table class="table text-center table-hover">
                            <tr>
                                <th>SL</th>
                                <th>User name</th>
                                <th>User email</th>
                                <th>Notify</th>
                            </tr>
                            <tr v-for="(user, index) in users" :key="user.id">
                                <td>{{ ++index }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>
                                    <button @click="notify(user.id)" class="btn btn-primary btn-sm"><i class="fa fa-bell"></i></button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                users : [],
                myId  : Number(document.getElementById('myId').value),
            }
        },
        mounted() {
            this.getUsers()

            Echo.private('testnotification')
                .listen('TestEvent', (e) => {
                    if (this.myId === e.testNotification.user_id) {
                        alert('You received a notification')
                    }
                });
        },
        methods :{
            getUsers(){
                axios.get('/users')
                .then(res => {
                    this.users = res.data
                })
                .catch(err => {
                    console.log(err);
                })
            },
            notify(e){
                axios.get('/notify/'+e)
                .then(res => {
                    console.log('Notification send');
                })
                .catch(err => {
                    console.log(err);
                })
            }
        }
    }
</script>
