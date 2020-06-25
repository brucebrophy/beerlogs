<template>
	<div class="rounded-lg my-2 md:my-0 overflow-hidden border border-gray-200 shadow-md bg-white">
		<div class="py-3 flex justify-center bg-indigo-600">
			<h4 class="font-mono text-white font-bold tracking-wider uppercase">Hops</h4>
		</div>
		<div class="p-3">
			<div v-for="(hop, index) in hopsAdded" :key="index">
				<input v-if="hop.id" type="hidden" :name="`hops[${index}][id]`" v-model="hop.id">
				<div class="row">
					<div class="col-12">
						<div class="mb-2 font-mono block">
							<select :name="`hops[${index}][hop_id]`" v-model="hop.hop_id" :id="`hop-${index}`" class="form-select text-gray-700 w-full border focus:border-indigo-600">
								<option :value="null" disabled selected>Hops...</option>
								<option v-for="hop in hops" :key="hop.id" :value="hop.id">{{ hop.name }}</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="mb-2 font-mono block">
							<label class="text-indigo-600 uppercase" :for="`type-${index}`">Type</label>
							<select :name="`hops[${index}][hop_type_id]`" v-model="hop.hop_type_id" :id="`type-${index}`" class="form-select text-gray-700 w-full border mt-2 focus:border-indigo-600">
								<option :value="null" disabled selected>Types...</option>
								<option v-for="type in types" :key="type.id" :value="type.id">{{ type.name }}</option>
							</select>
						</div>
					</div>
					<div class="col-6">
						<div class="mb-2 font-mono block">
							<label class="text-indigo-600 uppercase" :for="`method-${index}`">Method</label>
							<select :name="`hops[${index}][hop_method_id]`" v-model="hop.hop_method_id" :id="`method-${index}`" class="form-select text-gray-700 w-full border mt-2 focus:border-indigo-600">
								<option :value="null" disabled selected>Methods...</option>
								<option v-for="method in methods" :key="method.id" :value="method.id" :selected="method.name === 'Boil'">{{ method.name }}</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="lg:col-4">
						<div class="mb-2 font-mono block">
							<label class="text-indigo-600 uppercase" :for="`minute-${index}`">Minute</label>
							<input type="text" :name="`hops[${index}][minute]`" v-model="hop.minute" min="0" :id="`minute-${index}`" class="form-input font-mono w-full border mt-2 focus:border-indigo-600">
						</div>
					</div>
					<div class="lg:col-4">
						<div class="mb-2 font-mono block">
							<label class="text-indigo-600 uppercase" :for="`amount-${index}`">Amount</label>
							<input type="text" :name="`hops[${index}][amount]`" v-model="hop.amount" :id="`amount-${index}`" class="form-input font-mono w-full border mt-2 focus:border-indigo-600">
						</div>
					</div>
					<div class="lg:col-4">
						<div class="mb-2 font-mono block">
							<label class="text-indigo-600 uppercase" :for="`unit-${index}`">Unit</label>
							<select :name="`hops[${index}][unit_id]`" v-model="hop.unit_id" :id="`unit-${index}`" class="form-select text-gray-700 w-full border mt-2 focus:border-indigo-600">
								<option v-for="unit in filteredUnits" :key="unit.id" :value="unit.id">{{ unit.symbol }}</option>
							</select>
						</div>
					</div>
				</div>
				<hr v-if="hopsAdded.length > (index + 1)" class="my-3">
			</div>
			<div class="row">
				<div class="col">
					<div class="flex">
						<button type="button" @click="addHops" class="px-8 py-3 mt-2 mr-2 w-full inline-block border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">+</button>
						<button type="button" @click="removeHops" 
							class="px-8 py-3 mt-2 w-full inline-block border-2 border-red-600 text-red-600 font-mono hover:bg-red-600 disabled:opacity-50 hover:text-white font-bold tracking-wide bg-white" 
							:class="{ 'cursor-not-allowed' : isDisabled }"
							:disabled="isDisabled">-
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		selectedHops: {
			type: Array
		}
	},
	mounted() {
		this.getData();
		this.addHops();
		if (this.selectedHops.length) {
			this.hopsAdded = this.selectedHops;
		}
	},
	data() {
		return {
			hopsAdded: [],
			hops: [],
			types: [],
			methods: [],
			units: []
		};
	},
	computed: {
		filteredUnits() {
			return this.units.filter(unit => {
				return ["oz", "lb", "g", "kg", "ml"].includes(unit.symbol);
			});
		},
		isDisabled() {
			return this.hopsAdded.length < 2;
		}
	},
	methods: {
		addHops() {
			this.hopsAdded.push({
				hop_id: null,
				hop_type_id: null,
				hop_method_id: null,
				minute: null,
				amount: null,
				unit_id: 1
			});
		},
		removeHops() {
			this.hopsAdded.pop();
		},
		getData() {
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

			axios
				.get("/api/units")
				.then(data => {
					let { units } = data.data;
					this.units = units;
				})
				.catch(error => {
					console.log(error);
				});

			axios
				.get("/api/hops/methods")
				.then(data => {
					let { methods } = data.data;
					this.methods = methods;
				})
				.catch(error => {
					console.log(error);
				});
		}
	}
};
</script>