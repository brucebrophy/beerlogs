<template>
	<div class="my-6">
		<textarea class="form-input w-full font-mono w-full border" v-model="body" name="body" id="body" rows="4"></textarea>
		<button @click="saveComment" type="button" class="w-full mt-3 py-3 border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Add Comment</button>
	</div>
</template>

<script>
export default {
	props: {
		endpoint: {
			required: true,
			type: String
		},
		addComment: {
			required: true,
			type: Function
		}
	},
	data() {
		return {
			body: ""
		};
	},
	computed: {},
	methods: {
		saveComment() {
			axios
				.post(this.endpoint, {
					body: this.body
				})
				.then(data => {
					let { comment } = data.data;
					this.body = "";
					this.addComment(comment);
				})
				.catch(error => {
					console.log(error);
				});
		}
	}
};
</script>