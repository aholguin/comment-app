<script>
import NewComment from "../components/new-comment.vue";

export default {
    name: 'commentBox',
    components: {
        NewComment
    },
    props: {
        comment: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            collapsed: true,
        }
    },
    methods: {
        toggleCollapsed() {
            this.collapsed = !this.collapsed;
        },
        sendNewComment(userName, userComment, responseTo = null) {

            if (responseTo === null) {
                responseTo = this.comment.id;
            }
            this.$emit('add-new-reply', userName, userComment, responseTo);
            this.collapsed = true;
        },
        hasReplies() {
            return typeof this.comment.responses !== 'undefined';
        },
    },

}
</script>

<template>
    <div class="bg-white p-2">
        <div class="d-flex flex-row user-info">
            <img class="rounded-circle" :src="`https://i.pravatar.cc/${comment.id}`" width="40" alt="avatar">
            <div class="d-flex flex-column justify-content-start ml-2"><span
                class="d-block font-weight-bold name">{{ comment.user_name }}</span><span
                class="date text-black-50">{{ comment.created_at }}</span></div>
        </div>
        <div class="mt-2">
            <p class="comment-text">{{ comment.comment }}</p>
        </div>
    </div>
    <div v-if="!collapsed" class="bg-light p-2">

        <new-comment
            v-on:add-new-comment="sendNewComment"
        />

    </div>
    <div>
        <div class="d-flex flex-row fs-12">

            <div class="like p-2 cursor"><i class="fa fa-commenting-o">

            </i><span
                v-if="hasReplies()"
                class="ml-1" @click="toggleCollapsed"
                v-text="collapsed ? 'Reply' : '&#x2B06;\n Cancel'"
            ></span></div>
        </div>
    </div>
    <div v-if="hasReplies()" class="comment-replies">

        <comment
            v-for="reply in comment.responses"
            :key="reply['id']"
            :comment="reply"
            v-on:add-new-reply="sendNewComment"
        >
        </comment>

    </div>
</template>

<style>
.comment-replies {
    padding-left: 3.5rem;
}
</style>
