<template>
	<div class="rounded-lg my-2 md:my-0 overflow-hidden border border-gray-200 shadow-md bg-white">
		<div class="py-3 flex justify-center bg-indigo-600">
			<h4 class="font-mono text-white font-bold tracking-wider uppercase">Yeast</h4>
		</div>
		<div class="p-3">
			<div v-for="(n, index) in numberOfYeastsAdditions" :key="index">
				<div class="row">
					<div class="col-12">
						<div class="mb-2 font-mono block">
							<!-- <label class="text-indigo-600 uppercase" :for="`yeast-${n}`">Yeast</label> -->
							<select :name="`yeasts[${n}][yeast_id]`" :id="`yeast-${n}`" class="form-select text-gray-700 w-full border focus:border-indigo-600">
								<option disabled selected>Select...</option>
								<option v-for="yeast in yeasts" :key="yeast.id" :value="yeast.id">{{ yeast.name }}</option>
							</select>
						</div>
					</div>
				</div>
				<hr v-if="numberOfYeastsAdditions > n" class="my-3">
			</div>
			<div class="row">
				<div class="col">
					<div class="flex">
						<button type="button" @click="numberOfYeastsAdditions++" class="px-8 py-3 mt-2 mr-2 w-full inline-block border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">+</button>
						<button type="button" @click="numberOfYeastsAdditions--" 
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
			numberOfYeastsAdditions: 1,
			yeasts: []
		};
	},
	computed: {
		filteredUnits() {
			return this.units.filter(unit => {
				return ["lb", "kg"].includes(unit.symbol);
			});
		},
		isDisabled() {
			return this.numberOfYeastsAdditions < 2;
		}
	},
	methods: {
		getData() {
			axios
				.get("/api/yeasts")
				.then(data => {
					let { yeasts } = data.data;
					this.yeasts = yeasts;
				})
				.catch(error => {
					console.log(error);
				});
		}
	}
};
</script>