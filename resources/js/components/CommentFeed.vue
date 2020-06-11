<template>
	<div>
		<div v-if="comments.length > 0">
			<comment-card-component
				v-for="comment in comments"
				:comment="comment"
				:key="comment.id"
				:updateComment="updateComment"
				:deleteComment="deleteComment" />
		</div>
		<div v-else>
			<p class="block mx-auto p-4 text-center font-mono text-indigo-600">No one has left a comment yet..</p>
		</div>

		<comment-form-component
			v-if="user"
			:endpoint="endpoint"
			:addComment="addComment" />

		<div v-else class="block text-center mt-2">
			<a href="/login" class="inline-block mx-auto p-4 text-center font-mono text-indigo-600">Login to comment</a>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		endpoint: {
			required: true,
			type: String
		}
	},
	mounted() {
		this.getComments();
		this.user = window.user;
	},
	data() {
		return {
			comments: [],
			user: null
		};
	},
	computed: {},
	methods: {
		getComments() {
			axios
				.get(this.endpoint)
				.then(data => {
					let { comments } = data.data;
					this.comments = comments;
				})
				.catch(error => {
					console.log(error);
				});
		},
		addComment(comment) {
			this.comments.push(comment);
		},
		updateComment(comment, body) {
			axios
				.patch(`${this.endpoint}/${comment.id}`, {
					body
				})
				.then(data => {
					let newComment = data.data.comment;
					let index = this.comments.indexOf(comment);
					this.comments.splice(index, 1, newComment);
				})
				.catch(error => {
					console.log(error);
				});
		},
		deleteComment(comment) {
			axios
				.delete(`${this.endpoint}/${comment.id}`)
				.then(data => {
					let index = this.comments.indexOf(comment);
					this.comments.splice(index, 1);
				})
				.catch(error => {
					console.log(error);
				});
		}
	}
};
</script>
