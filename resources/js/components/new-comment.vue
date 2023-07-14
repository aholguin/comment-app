<script>
export default {
    name: 'new-comment-box',
    methods: {
        sendNewComment() {
            this.$emit('add-new-comment', this.userName, this.userComment);
            this.userComment = '';
            this.userName = '';
        },
    },
    data() {
        return {
            userComment: '',
            userName: '',
        };
    },
}
</script>

<template>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username"
               aria-describedby="basic-addon1"
               v-model="userName">
    </div>
    <div class="input-group">
          <textarea
              placeholder="Write a comment..."
              class="form-control ml-1 shadow-none textarea"
              v-model="userComment" @keyup.enter.prevent="sendNewComment" autofocus
          ></textarea>
    </div>
    <div class="mt-2 text-right">
        <button
            @click="sendNewComment"
            class="btn btn-primary btn-sm shadow-none"
            type="button">Post comment
        </button>
    </div>
</template>
