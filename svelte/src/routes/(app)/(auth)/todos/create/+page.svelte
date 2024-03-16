<script lang="ts">
	import { goto } from '$app/navigation';
	import TodoForm from '$lib/components/todoForm.svelte';
	import { fetchClient } from '$lib/js/fetchClient';

	const body = { task: '', completed: false };
	let errors = {};
	const submit = async () => {
		errors = {};
		const { data, error } = await fetchClient.POST('/todo', { body });
		if (error) {
			// @ts-ignore
			errors = error.errors;
			return;
		}
		goto('/todos', { invalidateAll: true });
	};
</script>

<TodoForm on:submit={submit} bind:task={body.task} bind:completed={body.completed} {errors} />
