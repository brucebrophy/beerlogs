<div class="row">
	<div class="col-12">
		<div class="rounded-lg mb-6 overflow-hidden border border-gray-200 shadow-md bg-white">
			<div class="p-6">
				<div class="row">
					<div class="col-6 lg:col-3">
						<div class="mb-2 font-mono block">
							{{ Form::label('abv', 'ABV', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							{{ Form::number('abv', $recipe->abv, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'Alcohol By Volume']) }}
						</div>
					</div>
					<div class="col-6 lg:col-3">
						<div class="mb-2 font-mono block">
							{{ Form::label('og', 'OG', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							{{ Form::number('og', $recipe->og, ['step' => '0.01', 'class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'Original Gravity']) }}
						</div>
					</div>
					<div class="col-6 lg:col-3">
						<div class="mb-2 font-mono block">
							{{ Form::label('fg', 'FG', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							{{ Form::number('fg', $recipe->og, ['step' => '0.01', 'class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'Final Gravity']) }}
						</div>
					</div>
					<div class="col-6 lg:col-3">
						<div class="mb-2 font-mono block">
							{{ Form::label('srm', 'SRM', ['class' => 'font-mono text-indigo-600 block uppercase']) }}
							{{ Form::number('srm', $recipe->srm, ['class' => 'form-input font-mono w-full border mt-2 focus:border-indigo-600', 'placeholder' => 'SRM']) }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="lg:col-4">
		<hop-selector-component />
	</div>
</div>

{{ Form::hidden('beer_id', $beer->id) }}