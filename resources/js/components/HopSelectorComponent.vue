<template>
	<div class="rounded-lg my-2 md:my-0 overflow-hidden border border-gray-200 shadow-md bg-white">
		<div class="p-6">
			<div v-for="(n, index) in numberOfHopAdditions" :key="index">
				<div class="row">
					<div class="col-6">
						<div class="mb-2 font-mono block">
							<label class="text-indigo-600 uppercase" for="unit">Hops</label>
							<select name="hop_id" id="hop_input" class="form-select text-gray-700 w-full border mt-2 focus:border-indigo-600">
								<option disabled selected>Select...</option>
								<option v-for="hop in hops" :key="hop.id">{{ hop.name }}</option>
							</select>
						</div>
					</div>
					<div class="col-6">
						<div class="mb-2 font-mono block">
							<label class="text-indigo-600 uppercase" for="unit">Type</label>
							<select name="hop_id" id="hop_input" class="form-select text-gray-700 w-full border mt-2 focus:border-indigo-600">
								<option v-for="type in types" :key="type.id">{{ type.name }}</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="lg:col-4">
						<div class="mb-2 font-mono block">
							<label class="text-indigo-600 uppercase" for="minute">Minute</label>
							<input type="number" min="0" name="" id="" class="form-input font-mono w-full border mt-2 focus:border-indigo-600">
						</div>
					</div>
					<div class="lg:col-4">
						<div class="mb-2 font-mono block">
							<label class="text-indigo-600 uppercase" for="unit">Amount</label>
							<input type="number" name="" id="" class="form-input font-mono w-full border mt-2 focus:border-indigo-600">
						</div>
					</div>
					<div class="lg:col-4">
						<div class="mb-2 font-mono block">
							<label class="text-indigo-600 uppercase" for="unit">Unit</label>
							<select name="unit" id="hop_input" class="form-select text-gray-700 w-full border mt-2 focus:border-indigo-600">
								<option>g</option>
								<option>kg</option>
								<option>oz</option>
								<option>lb</option>
								<option>ml</option>
							</select>
						</div>
					</div>
				</div>
				<hr v-if="numberOfHopAdditions > n" class="my-3">
			</div>
			<div class="row">
				<div class="col">
					<button type="button" @click="numberOfHopAdditions++" class="px-8 py-3 mt-2 d-block w-full border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Add Hops</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {},
	mounted() {
		this.getHopData();
	},
	data() {
		return {
			numberOfHopAdditions: 1,
			hops: [],
			types: []
		};
	},
	methods: {
		getHopData() {
			axios
				.get("/api/hops")
				.then(data => {
					let { hops } = data.data;
					this.hops = hops;
				})
				.catch(error => {
					console.log(error);
				});

			axios
				.get("/api/hops/types")
				.then(data => {
					let { types } = data.data;
					this.types = types;
				})
				.catch(error => {
					console.log(error);
				});
		}
	}
};
</script>