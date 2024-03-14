<script lang="ts">
	export let data;
</script>

<h1 class="title">Todos</h1>
<ul>
	{#each data.todos as todo}
		<li>
			<p>{todo.task}</p>
			<input type="checkbox" readonly={true} checked={todo.completed} class="checkbox" />
		</li>
	{/each}
</ul>
<pre style="white-space: pre;">{JSON.stringify({ todos: data.todos }, null, 8)}</pre>
