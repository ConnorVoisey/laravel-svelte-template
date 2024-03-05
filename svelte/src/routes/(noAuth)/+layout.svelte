<script lang="ts">
	import '../../styles/main.scss';
	import { page } from '$app/stores';
</script>

<div class="page">
	<div class="page-content card-lg" class:register-view={$page.route.id === '/(noAuth)/register'}>
		<div class="login">
			{#if $page.route.id === '/(noAuth)/login'}
				<slot />
			{:else}
				<a href="/login" class="thin-link">
					<p>Already have an account</p>
					<h2 class="subtitle">Login</h2>
				</a>
			{/if}
		</div>
		<hr class="vertical" />
		<div class="register">
			{#if $page.route.id === '/(noAuth)/register'}
				<slot />
			{:else}
				<a href="/register" class="thin-link">
					<p>Don't have an account</p>
					<h2 class="subtitle">Register</h2>
				</a>
			{/if}
		</div>
	</div>
</div>

<style lang="scss">
	hr.vertical {
		width: 2px;
		height: auto;
		background-color: on-surface(1);
	}
	.page {
		min-height: 100vh;
		display: grid;
		align-items: center;
		justify-items: center;
		align-items: center;
		background-color: surface(0);
		.page-content {
			background-color: surface(1);
			display: grid;
			gap: size(8);
			grid-template-columns: max-content max-content max-content;
			&.register-view {
				.login {
					max-width: size(24);
				}
				.register {
					max-width: 100%;
				}
			}
			.register {
				max-width: size(24);
			}
		}
		.thin-link {
			display: flex;
			flex-direction: column;
			max-width: 100%;
			justify-content: center;
			height: 100%;
		}
	}
</style>
