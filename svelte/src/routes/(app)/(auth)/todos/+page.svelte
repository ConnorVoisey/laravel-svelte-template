<script lang="ts">
	import { goto } from '$app/navigation';
	import Field from '$lib/components/field.svelte';
	import Checkbox from '$lib/components/fields/checkbox.svelte';
	import { fetchClient } from '$lib/js/fetchClient.js';
	import { error } from '@sveltejs/kit';

	export let data;

	const body = {
		task: '',
		completed: false
	};
	const createTodo = async () => {
		const res = await fetchClient.POST('/todos', {
			//@ts-ignore //TODO: fix the typing for this
			body
		});
		if (res.error) error(res.response.status, res.error);
		body.task = '';

		goto('/todos', { invalidateAll: true });
	};
	const updateTodo = async ({
		id,
		task,
		completed
	}: {
		id: string;
		task: string;
		completed: boolean;
	}) => {
		const res = await fetchClient.PATCH('/todos/{id}', {
			body: {
				task,
				completed
			},
			params: {
				path: {
					id
				}
			}
		});

		if (res.error) error(500, res.error);

		goto('/todos', { invalidateAll: true });
	};
	const deleteTodo = async (id: string) => {
		const res = await fetchClient.DELETE('/todos/{id}', {
			params: {
				path: {
					id
				}
			}
		});

		if (res.error) error(res.response.status, res.error);

		goto('/todos', { invalidateAll: true });
	};
</script>

<h1 class="title">Todos</h1>

<form on:submit|preventDefault={createTodo}>
	<Field name="task" bind:value={body.task} placeholder="Add a todo" />
	<button type="submit" class="btn-primary">Create</button>
</form>

<hr />

<ul class="todos-list">
	{#each data.todos as todo (todo.id)}
		<li
			class="todo-row"
			class:completed={todo.completed}
			style:view-transition-name={`todo-row-${todo.id}`}
		>
			<input
				bind:value={todo.task}
				on:blur={() =>
					updateTodo({ id: todo.id, completed: todo.completed ?? false, task: todo.task })}
			/>
			<Checkbox
				bind:checked={todo.completed}
				on:input={() =>
					setTimeout(
						() => updateTodo({ id: todo.id, completed: todo.completed ?? false, task: todo.task }),
						0
					)}
			/>
			<button class="btn-error" on:click={() => deleteTodo(todo.id)}>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					<title>Delete</title>
					<path
						d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z"
					/>
				</svg>
			</button>
		</li>
	{/each}
</ul>

<style lang="scss">
	hr {
		height: 2px;
		background-color: primary(5);
		margin: size(4) 0 size(8);
	}
	form {
		display: grid;
		grid-template-columns: 1fr max-content;
		gap: size(4);
		align-items: center;
		button {
			height: max-content;
		}
	}
	.todos-list {
		display: flex;
		flex-direction: column;
		gap: size(2);
	}
	.todo-row {
		display: grid;
		grid-template-columns: 1fr max-content size(10);
		gap: size(4);
		&.completed {
			text-decoration: line-through;
		}
	}
	.btn-error {
		padding: size(1) size(2);
		svg {
			fill: on-error(1);
			width: size(6);
		}
	}
</style>
