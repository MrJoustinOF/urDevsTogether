<template>

    <input type="submit" class="btn btn-danger mt-1" value="Delete" @click="deleteProject">

</template>

<script>

    export default {
        props: ['projectId'],
        methods: {
            deleteProject(id) {
                this.$swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        const params = {
                            id: this.projectId,
                        }

                        axios.post(`/projects/${this.projectId}`, {params, _method: 'delete'})
                            .then(res => {
                                this.$swal({
                                    title: 'Project Deleted',
                                    text: 'Your project has been deleted',
                                    icon: 'success'
                                })

                                this.$el.parentNode.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode.parentNode)
                            })

                            .catch(err => console.log(err))

                        
                    }
                })
            }
        }
    }

</script>