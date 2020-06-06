<template>
	<div class="rounded-lg my-2 md:my-0 overflow-hidden border border-gray-200 shadow-md bg-white">
		<div class="py-3 flex justify-center bg-indigo-600">
			<h4 class="font-mono text-white font-bold tracking-wider uppercase">Malts</h4>
		</div>
		<div class="p-3">
			<div v-for="(malt, index) in maltsAdded" :key="index">
				<input v-if="malt.id" type="hidden" :name="`malts[${index}][id]`" v-model="malt.id">
				<div class="row">
					<div class="col-12">
						<div class="mb-2 font-mono block">
							<select :name="`malts[${index}][malt_id]`" v-model="malt.malt_id" :id="`malt-${index}`" class="form-select text-gray-700 w-full border focus:border-indigo-600">
								<option :value="null" disabled selected>Malts...</option>
								<option v-for="malt in malts" :key="malt.id" :value="malt.id">{{ malt.name }}</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="lg:col-6">
						<div class="mb-2 font-mono block">
							<label class="text-indigo-600 uppercase" :for="`malt-amount-${index}`">Amount</label>
							<input type="number" :name="`malts[${index}][amount]`" v-model="malt.amount" :id="`malt-amount-${index}`" class="form-input font-mono w-full border mt-2 focus:border-indigo-600">
						</div>
					</div>
					<div class="lg:col-6">
						<div class="mb-2 font-mono block">
							<label class="text-indigo-600 uppercase" :for="`malt-unit-${index}`">Unit</label>
							<select :name="`malts[${index}][unit_id]`" v-model="malt.unit_id" :id="`malt-unit-${index}`" class="form-select text-gray-700 w-full border mt-2 focus:border-indigo-600">
								<option v-for="unit in filteredUnits" :key="unit.id" :value="unit.id">{{ unit.symbol }}</option>
							</select>
						</div>
					</div>
				</div>
				<hr v-if="maltsAdded.length > (index + 1)" class="my-3">
			</div>
			<div class="row">
				<div class="col">
					<div class="flex">
						<button type="button" @click="addMalts" class="px-8 py-3 mt-2 mr-2 w-full inline-block border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">+</button>
						<button type="button" @click="removeMalts" 
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
		selectedMalts: {
			type: Array
		}
	},
	mounted() {
		this.getData();
		this.addMalts();
		if (this.selectedMalts.length) {
			this.maltsAdded = this.selectedMalts;
		}
	},
	data() {
		return {
			maltsAdded: [],
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
			return this.maltsAdded.length < 2;
		}
	},
	methods: {
		addMalts() {
			this.maltsAdded.push({
				malt_id: null,
				amount: null,
				unit_id: 1
			});
		},
		removeMalts() {
			this.maltsAdded.pop();
		},
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