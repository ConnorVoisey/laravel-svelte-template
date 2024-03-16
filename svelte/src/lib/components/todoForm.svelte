<script lang="ts">
	import Field from '$lib/components/field.svelte';
	import { createEventDispatcher } from 'svelte';

	export let task = '';
	export let completed = false;
	export let errors: Record<string, string[]>;

	const dispatch = createEventDispatcher();

	const submit = (e: Event) => dispatch('submit', e);
</script>

<form on:submit|preventDefault={submit}>
	<legend class="title">Create Todo</legend>
	<fieldset>
		<Field name="task" label="Task" bind:value={task} errors={errors.task} />
		<div class="field">
			<label for="completed" class="label">Completed</label>
			<input type="checkbox" name="completed" bind:checked={completed} class="checkbox" />
		</div>
	</fieldset>
	<button type="submit" class="btn-primary">Create</button>
</form>
