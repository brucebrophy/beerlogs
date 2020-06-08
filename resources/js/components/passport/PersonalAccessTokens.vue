<template>
    <div class="mt-6">
		<div class="rounded-lg my-2 md:my-0 overflow-hidden border border-gray-200 shadow-md bg-white">
			<div class="py-3 flex justify-center bg-indigo-600">
				<h4 class="font-mono text-white font-bold tracking-wider uppercase">Personal Access Tokens</h4>
			</div>
			<div class="p-8">
				<!-- No Tokens Notice -->
				<p class="text-center font-mono my-6" v-if="tokens.length === 0 && ! showForm">
					You have not created any personal access tokens.
				</p>
				<table class="w-full mb-6" v-if="tokens.length > 0">
					<thead>
						<tr>
							<th class="text-left font-mono font-semibold py-2">Token Name</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="token in tokens" :key="token.id">
							<td class="border-t border-b border-gray-400 py-3 font-mono" style="vertical-align: middle;">
								{{ token.name }}
							</td>							
							<td class="border-t border-b border-gray-400 py-3 text-right" style="vertical-align: middle;">
								<button class="text-red-600 font-mono" @click="revoke(token)">
									Delete
								</button>
							</td>
						</tr>
					</tbody>
				</table>

				<!-- Create Token Form -->
				<form v-if="showForm" role="form" @submit.prevent="store">
					<!-- Form Errors -->
					<div class="alert alert-danger mb-6" v-if="form.errors.length > 0">
						<p><strong>Whoops!</strong> Something went wrong!</p>
						<ul class="mt-2">
							<li v-for="error in form.errors">
								{{ error }}
							</li>
						</ul>
					</div>

					<!-- Name -->
					<label class="font-mono text-indigo-600 block uppercase">Name</label>
					<input id="create-token-name" type="text" class="form-input font-mono w-full border mt-2 focus:border-indigo-600" name="name" v-model="form.name">

					<!-- Scopes -->
					<!-- <div class="form-group row" v-if="scopes.length > 0">
						<label class="col-md-4 col-form-label">Scopes</label>
						<div class="col-md-6">
							<div v-for="scope in scopes">
								<div class="checkbox">
									<label>
										<input type="checkbox" @click="toggleScope(scope.id)" :checked="scopeIsAssigned(scope.id)">
										{{ scope.id }}
									</label>
								</div>
							</div>
						</div>
					</div> -->
				</form>

				<div v-if="accessToken">
					<p class="font-mono leading-normal mt-6">
						Here is your new personal access token. This is the only time it will be shown so don't lose it!
						You may now use this token to make API requests.
					</p>
					<textarea class="form-input font-mono w-full border mt-2 focus:border-indigo-600" rows="10">{{ accessToken }}</textarea>
				</div>

				<div class="flex justify-end">
					<button v-if="showForm" @click="showForm = false" class="mt-4 p-3 mr-3 font-mono">Cancel</button>
					<button v-if="!showForm" @click="showForm = true" type="submit" class="mt-4 px-8 py-3 border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Create New Token</button>
					<button v-if="showForm" @click="store" class="mt-4 px-8 py-3 border-2 border-indigo-600 text-indigo-600 font-mono hover:bg-indigo-600 hover:text-white font-bold tracking-wide bg-white">Create New Token</button>
				</div>
			</div>
		</div>
    </div>
</template>

<script>
export default {
	/*
	 * The component's data.
	 */
	data() {
		return {
			showForm: false,
			accessToken: null,
			tokens: [],
			scopes: [],
			form: {
				name: "",
				scopes: [],
				errors: []
			}
		};
	},

	/**
	 * Prepare the component (Vue 2.x).
	 */
	mounted() {
		this.prepareComponent();
	},

	methods: {
		/**
		 * Prepare the component.
		 */
		prepareComponent() {
			this.getTokens();
			this.getScopes();
		},

		/**
		 * Get all of the personal access tokens for the user.
		 */
		getTokens() {
			axios.get("/oauth/personal-access-tokens").then(response => {
				this.tokens = response.data;
			});
		},

		/**
		 * Get all of the available scopes.
		 */
		getScopes() {
			axios.get("/oauth/scopes").then(response => {
				this.scopes = response.data;
			});
		},
		showCreateTokenForm() {
			this.showForm = true;
		},
		store() {
			this.accessToken = null;
			this.form.errors = [];
			axios
				.post("/oauth/personal-access-tokens", this.form)
				.then(response => {
					this.form.name = "";
					this.form.scopes = [];
					this.form.errors = [];
					this.tokens.push(response.data.token);
					this.showAccessToken(response.data.accessToken);
				})
				.catch(error => {
					if (typeof error.response.data === "object") {
						this.form.errors = _.flatten(
							_.toArray(error.response.data.errors)
						);
					} else {
						this.form.errors = [
							"Something went wrong. Please try again."
						];
					}
				});
		},

		/**
		 * Toggle the given scope in the list of assigned scopes.
		 */
		toggleScope(scope) {
			if (this.scopeIsAssigned(scope)) {
				this.form.scopes = _.reject(this.form.scopes, s => s == scope);
			} else {
				this.form.scopes.push(scope);
			}
		},

		/**
		 * Determine if the given scope has been assigned to the token.
		 */
		scopeIsAssigned(scope) {
			return _.indexOf(this.form.scopes, scope) >= 0;
		},

		/**
		 * Show the given access token to the user.
		 */
		showAccessToken(accessToken) {
			this.showToken = true;
			this.accessToken = accessToken;
			this.showForm = false;
		},

		/**
		 * Revoke the given token.
		 */
		revoke(token) {
			axios
				.delete("/oauth/personal-access-tokens/" + token.id)
				.then(response => {
					this.getTokens();
				});
		}
	}
};
</script>

<style scoped>
.action-link {
	cursor: pointer;
}
</style>