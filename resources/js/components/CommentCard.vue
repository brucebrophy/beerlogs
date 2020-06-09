<template>
	<div class="flex w-full rounded-lg mb-2 overflow-hidden border border-indigo-600 bg-white">				
		<div class="p-4 pt-0 w-full">
			<div v-if="!isEditing">
				<p class="whitespace-pre-line font-mono">
					{{ comment.body }}
				</p>
			</div>
			<div v-else>
				<textarea v-model="body" class="mt-4 form-input w-full font-mono w-full border" rows="2"></textarea>
			</div>
			<div class="flex justify-between mt-3 text-gray-600">
				<div>
					<a class="text-indigo-600" :href="`/@${comment.user.username}`">@{{ comment.user.username }}</a>  <span class="mx-1">•</span>  {{ createdAtString }}
				</div>
				<div v-if="user && user.id === comment.user.id" class="flex items-center">
					<div v-if="!isEditing">
						<a @click.prevent="toggleEditing" href="#" class="text-indigo-600">Edit</a>
						<span class="inline-block text-gray-500 mx-1">|</span>
						<a @click.prevent="deleteComment(comment)" href="#" class="text-red-600">Delete</a>
					</div>
					<div v-else>
						<a @click.prevent="toggleEditing" href="#" class="text-gray-600">Cancel</a>
						<span class="inline-block text-gray-500 mx-1">|</span>
						<a @click.prevent="update" href="#" class="text-indigo-600">Update</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import moment from "moment";

export default {
	mounted() {
		this.user = window.user;
	},
	props: {
		comment: {
			required: true,
			type: Object
		},
		updateComment: {
			required: true,
			type: Function
		},
		deleteComment: {
			required: true,
			type: Function
		}
	},
	data() {
		return {
			body: "",
			isEditing: false,
			user: null
		};
	},
	computed: {
		createdAtString() {
			return moment(this.comment.created_at).fromNow();
		}
	},
	methods: {
		toggleEditing() {
			this.body = this.comment.body;
			this.isEditing = !this.isEditing;
		},
		update() {
			this.updateComment(this.comment, this.body);
			this.body = "";
			this.isEditing = false;
		}
	}
};
</script>