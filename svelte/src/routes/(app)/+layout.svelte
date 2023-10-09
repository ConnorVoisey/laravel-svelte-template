<script lang="ts">
	import '../../styles/main.scss';
	import Header from '$lib/components/header.svelte';
	export let data;
</script>

<div class="page">
	<div class="header">
		<Header user={data.user} />
	</div>
	<div class="page-content">
		<slot />
	</div>
</div>

<style lang="scss">
	.header {
		margin-bottom: size(8);
	}
	.page-content {
		@include content-width;
	}
</style>
