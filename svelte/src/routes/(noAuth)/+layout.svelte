<script lang="ts">
	import { page } from '$app/stores';
	import '../../styles/main.scss';
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
	<ul class="background">
		{#each { length: 15 } as _}
			<li />
		{/each}
	</ul>
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
		& > * {
			grid-area: 1 / 1 / 2 / 2;
			width: max-content;
		}
		.page-content {
			background-color: surface(0);
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
		.background {
			background: linear-gradient(20deg, primary(7), primary(9));
			width: 100%;
			height: 100%;
			z-index: -1;
			position: relative;
			overflow: hidden;
			li {
				position: absolute;
				display: block;
				list-style: none;
				width: 20px;
				height: 20px;
				bottom: -300px;
			}
			@for $i from 1 through 15 {
				//$size: random(130) + 60 + px;
				$size: random(50) + 20 + px;
				li:nth-child(#{$i}) {
					left: percentage(calc(random(100) / 100));
					box-shadow: 0 0 $size 20px #ffffff;
					width: 0px;
					height: 0px;
					animation: animate 25s linear infinite;
					animation-delay: random(35) - 20 + s;
					animation-duration: random(20) + 5 + s;
					border-radius: random(30) + px;
				}
				//$size: random(130) + 60 + px;
				$size: random(60) + 10 + px;
				li:nth-child(#{$i})::before {
					position: fixed;
					inset: 0;
					content: '';
					display: flex;
					bottom: percentage(calc(random(100) / 100));
					width: $size;
					height: $size;
					background: #ffffff33;
					animation: animate-x 25s linear infinite, fade-in-out 3s linear infinite;
					animation-delay: random(3000) + ms;
					border-radius: random(30) + px;
				}
			}
			@keyframes animate {
				0% {
					transform: translateY(0) rotate(0deg);
					opacity: 1;
				}

				100% {
					transform: translateY(-1000px) rotate(720deg);
					opacity: 0;
					border-radius: 60%;
				}
			}
			@keyframes fade-in-out {
				0% {
					opacity: 0;
				}
				50% {
					opacity: 1;
				}
				100% {
					opacity: 0;
				}
			}
			@keyframes animate-x {
				0% {
					transform: translateX(0) rotate(0deg);
					opacity: 1;
				}

				100% {
					transform: translateX(-1000px) rotate(720deg);
					opacity: 0;
					border-radius: 60%;
				}
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
