<template>
	<div class="rounded-lg my-2 md:my-0 overflow-hidden border border-gray-200 shadow-md bg-white">
		<div class="p-6">
			<div class="row">
				<div class="col-8">
					<div class="mb-5 font-mono text-indigo-600 block uppercase">
						<label for="hop_input">Add Hops</label>
						<select name="" id="hop_input" class="form-select text-gray-700 w-full border mt-2 focus:border-indigo-600">
							<option disabled selected>Select...</option>
							<option v-for="hop in hops" :key="hop.id">{{ hop.name }}</option>
						</select>
					</div>
				</div>
				<div class="col-4">
					<div class="mb-5 font-mono text-indigo-600 block uppercase">
						<label for="hop_input">Unit</label>
						<input type="text" name="" id="" class="form-input font-mono w-full border mt-2 focus:border-indigo-600">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="lg:col-4">
					<div class="mb-5 font-mono text-indigo-600 block uppercase">
						<label for="hop_input">Minute</label>
						<input type="text" name="" id="" class="form-input font-mono w-full border mt-2 focus:border-indigo-600">
					</div>
				</div>
				<div class="lg:col-4">
					<div class="mb-5 font-mono text-indigo-600 block uppercase">
						<label for="hop_input">Amount</label>
						<input type="text" name="" id="" class="form-input font-mono w-full border mt-2 focus:border-indigo-600">
					</div>
				</div>
				<div class="lg:col-4">
					<div class="mb-5 font-mono text-indigo-600 block uppercase">
						<label for="hop_input">Type</label>
						<input type="text" name="" id="" class="form-input font-mono w-full border mt-2 focus:border-indigo-600">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<button type="button" class="px-8 py-3 d-block w-full border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Add Hops</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {},
	mounted() {
		this.hops = beerlogs.hops;
	},
	data() {
		return {
			hops: [],
			minute: 0,
			amount: 0,
			unit: "oz",
			selectedHops: []
		};
	},
	methods: {}
};
</script>