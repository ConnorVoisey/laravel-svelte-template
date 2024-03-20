<script lang="ts">
	export let value: string | number = '';
	export let name: string;
	export let label: string | null = null;
	export let type: 'text' | 'number' | 'email' | 'password' = 'text';
	export let placeholder = label;
	export let required = false;
	export let errors: string[] = [];

	const handleInput = (e: Event & { currentTarget: EventTarget & HTMLInputElement }) => {
		value = type.match(/^(number|range)$/) ? +e.currentTarget.value : e.currentTarget.value;
	};
</script>

<div class="field">
	<div class="errors">
		{#if errors}
			{#each errors as error}
				<p class="error">{error}</p>
			{/each}
		{/if}
	</div>
	<label>
		<input {type} {value} {name} {placeholder} {required} on:input={handleInput} />
		{#if label !== null}
			<p>{label}</p>
		{/if}
		<span><slot /></span>
		<div class="box" />
	</label>
</div>

<style lang="scss">
	.field {
		display: flex;
		flex-direction: column;
		gap: size(1);
		--box-clr: #{on-surface(1)};
		label:focus-within p {
			color: on-surface(2);
			transition: color 200ms;
		}
	}
	label {
		display: grid;
		gap: size(2) 0;
		grid-template-columns: max-content 1fr;
		grid-template-rows: max-content 1fr max-content;
		grid-template-areas:
			'label label'
			'icon input';
		span {
			grid-area: icon;
			display: flex;
			:global(svg) {
				width: size(8);
				fill: var(--box-clr);
				padding: size(1) size(2);
				padding-right: size(0);
				transition: fill 200ms;
			}
		}
		input {
			grid-area: input;
			padding: size(2);
			transition: color 200ms;
			color: on-surface(1);
			z-index: 1;
			&::placeholder {
				color: on-surface(2);
			}
		}
		p {
			grid-area: label;
			font-weight: var(--fw-semibold);
		}
		.box {
			grid-area: 2 / 1 / 3 / 3;
			border: solid 0.5px var(--box-clr);
			padding: size(2);
			border-radius: size(2);
			transition: box-shadow 200ms;
		}
	}

	:global(input:focus + p + span svg, input:focus + p + span + .box) {
		--box-clr: #{primary(5)};
	}
	.error {
		color: error(5);
		font-weight: var(--fw-semibold);
		width: 100%;
	}
</style>
