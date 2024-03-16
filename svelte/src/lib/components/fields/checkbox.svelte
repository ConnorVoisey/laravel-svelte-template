<script lang="ts">
	import { createEventDispatcher } from 'svelte';

	export let checked = false;
	export let label: string | null = null;
	export let name: string | null = null;
	export let id = name;
	export let disabled = false;

	const dispatch = createEventDispatcher();
</script>

<label>
	{#if label !== null}
		<p class="label">{label}</p>
	{/if}
	<input
		type="checkbox"
		bind:checked
		class="checkbox"
		{name}
		{id}
		{disabled}
		on:input={(e) => dispatch('input', e)}
	/>
</label>

<style lang="scss">
	label {
		display: flex;
		flex-wrap: wrap;
		gap: size(1) size(4);
		justify-content: space-between;
		align-items: center;
	}

	.checkbox {
		width: size(6);
		height: size(6);
		border-radius: size(2);
		border: solid 2px primary(5);
		position: relative;
		transition: all 100ms;
		&:checked {
			background-color: primary(5);
			opacity: 1;
			&:before {
				border-color: on-primary(1);
			}
		}
		&:before {
			content: '';
			position: absolute;
			right: calc(50% + 1px);
			top: 50%;
			width: 4px;
			height: 10px;
			border: solid transparent;
			border-width: 0 2px 2px 0;
			margin: -1px -1px 0 -1px;
			transform: rotate(45deg) translate(-50%, -50%);
			z-index: 2;
		}
	}
</style>
