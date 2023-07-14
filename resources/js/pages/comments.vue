<template>
    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-8">
                <div class="d-flex flex-column comment-section">
                    <div class="bg-light p-2">

                        <new-comment
                            v-on:add-new-comment="newComment"
                        />

                    </div>

                    <comment
                        v-for="comment in comments"
                        :key="comment['id']"
                        :comment="comment"
                        v-on:add-new-reply="newComment"
                    >
                    </comment>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Comment from "../components/comment.vue";
import NewComment from "../components/new-comment.vue";

export default {
    name: 'Comments',
    components: {
        Comment,
        NewComment,
    },
    data() {
        return {
            comments: [],
        };
    },
    mounted() {
        this.loadComment();
    },
    methods: {
        async loadComment() {
            const response = await axios.get('/api/comments');

            this.comments = response.data;

        },
        async newComment(userName, userComment, responseTo = null) {
            if (!userComment || !userName) return;
            await axios.post('/api/comments/new', {
                user_name: userName,
                comment: userComment,
                response_to: responseTo,
            });
            await this.loadComment();
        },
    },
};
</script>


