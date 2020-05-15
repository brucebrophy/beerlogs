<template>
	<div>
		<div class="mb-5 font-mono text-indigo-600 block uppercase">
			<label :for="resource">Add {{ resource }}</label>
			<select name="" :id="resource" class="form-select text-gray-700 w-full border mt-2 focus:border-indigo-600">
				<option disabled selected>Select...</option>
				<option v-for="item in items" :key="item.id">{{ item.name }}</option>
			</select>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		endpoint: {
			type: String,
			required: true
		},
		resource: {
			type: String,
			required: true
		}
	},
	mounted() {
		this.getEndpointData();
	},
	data() {
		return {
			items: []
		};
	},
	methods: {
		getEndpointData() {
			axios
				.get(this.endpoint)
				.then(data => {
					this.items = data.data[this.resource];
				})
				.catch(error => {
					console.log(error);
				});
		}
	}
};
</script>