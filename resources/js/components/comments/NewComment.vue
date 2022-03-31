<template>
    <div>
        <form @submit.prevent="handleSubmit">
            <input v-model="(form.username)" placeholder="Username" class="form-control" style="background-color:white" type="text">
            <textarea v-model="form.content" placeholder="What do you think about this post? Leave your comment" style="background-color:white" autofocus class="my-3 form-control" rows="5"></textarea>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
import useComments from '../composables/comments'
import { reactive } from 'vue'

export default {
    props: {
        id: {
            required: false,
            type: Number
        }
    },
    setup(props, context) {
        const { storeComment }= useComments()

        let form = reactive({
            'username': '',
            'content': '',
            'post_id': 1,
        })

        if(props.id) {
            form = reactive({
                'username': '',
                'content': '',
                'post_id': 1,
                'parent_id': props.id
            })
        }

        const handleSubmit = () => {

            storeComment({ ...form })
                .then(res => {
                    context.emit('load');
                    // this.$parent.reload();
                })
                .catch(e => console.log(e))

        }
        return {
            form,
            handleSubmit
        }
    }
}
</script>

<style>

</style>
