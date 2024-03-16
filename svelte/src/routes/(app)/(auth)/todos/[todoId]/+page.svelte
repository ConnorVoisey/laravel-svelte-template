<script lang="ts">
	export let data;
	const todo = data.todo;
</script>

<h1 class="title">Todo</h1>

<p>Task: {todo.task}</p>
<p>Completed: {todo.completed}</p>
