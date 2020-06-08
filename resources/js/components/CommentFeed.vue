<template>
	<div>
		<div v-for="comment in comments" :key="comment.id">
			{{ comment.body }}
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
	},
	data() {
		return {
			comments: []
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
		}
	}
};
</script>