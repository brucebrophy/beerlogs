<template>
	<div class="rounded-lg my-2 md:my-0 overflow-hidden border border-gray-200 shadow-md bg-white">
		<div class="py-3 flex justify-center bg-indigo-600">
			<h4 class="font-mono text-white font-bold tracking-wider uppercase">Malts</h4>
		</div>
		<div class="p-3">
			<div v-for="(n, index) in numberOfMaltAdditions" :key="index">
				<div class="row">
					<div class="col-12">
						<div class="mb-2 font-mono block">
							<!-- <label class="text-indigo-600 uppercase" :for="`malt-${n}`">Malts</label> -->
							<select :name="`malts[${n}][malt_id]`" :id="`malt-${n}`" class="form-select text-gray-700 w-full border focus:border-indigo-600">
								<option disabled selected>Select...</option>
								<option v-for="malt in malts" :key="malt.id" :value="malt.id">{{ malt.name }}</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="lg:col-6">
						<div class="mb-2 font-mono block">
							<label class="text-indigo-600 uppercase" :for="`malt-amount-${n}`">Amount</label>
							<input type="number" :name="`malts[${n}][amount]`" :id="`malt-amount-${n}`" class="form-input font-mono w-full border mt-2 focus:border-indigo-600">
						</div>
					</div>
					<div class="lg:col-6">
						<div class="mb-2 font-mono block">
							<label class="text-indigo-600 uppercase" :for="`malt-unit-${n}`">Unit</label>
							<select :name="`malts[${n}][unit_id]`" :id="`malt-unit-${n}`" class="form-select text-gray-700 w-full border mt-2 focus:border-indigo-600">
								<option v-for="unit in filteredUnits" :key="unit.id" :value="unit.id">{{ unit.symbol }}</option>
							</select>
						</div>
					</div>
				</div>
				<hr v-if="numberOfMaltAdditions > n" class="my-3">
			</div>
			<div class="row">
				<div class="col">
					<div class="flex">
						<button type="button" @click="numberOfMaltAdditions++" class="px-8 py-3 mt-2 mr-2 w-full inline-block border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">+</button>
						<button type="button" @click="numberOfMaltAdditions--" 
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
	props: {},
	mounted() {
		this.getData();
	},
	data() {
		return {
			numberOfMaltAdditions: 1,
			malts: [],
			units: []
		};
	},
	computed: {
		filteredUnits() {
			return this.units.filter(unit => {
				return ["lb", "kg"].includes(unit.symbol);
			});
		},
		isDisabled() {
			return this.numberOfMaltAdditions < 2;
		}
	},
	methods: {
		getData() {
			axios
				.get("/api/malts")
				.then(data => {
					let { malts } = data.data;
					this.malts = malts;
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
		}
	}
};
</script>