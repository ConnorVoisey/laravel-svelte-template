<script lang="ts">
	import ThemeSelector from './themeSelector.svelte';
	import UserIcon from './userIcon.svelte';
	export let user: User | null;
</script>

<div class="header-wrapper">
	<header>
		<a href="/" class="title-on-primary">Shgrid</a>
		<input type="checkbox" id="hamburger-toggle" aria-hidden="true" />
		<label for="hamburger-toggle" class="menu" aria-hidden="true">
			<svg class="open-btn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
				><title>open menu</title><path d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z" /></svg
			>
			<svg class="close-btn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
				><title>close menu</title><path
					d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"
				/></svg
			>
		</label>
		<nav>
			<ul>
				<li><a href="/todos">Todos</a></li>
				<li><a href="/examples">Examples</a></li>
				<li><a href="/docs">Documentation</a></li>
			</ul>
			<ul class="additional">
				<li>
					<UserIcon {user} />
				</li>
				<li>
					<ThemeSelector />
				</li>
			</ul>
		</nav>
	</header>
</div>

<style lang="scss">
	// -- start region: All styling
	.header-wrapper {
		background-color: primary(5);
	}
	header {
		@include content-width;
		color: on-primary(0);
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: size(4) 0;
		position: relative;
	}
	.menu {
		svg {
			width: size(8);
			fill: on-primary(1);
		}
	}
	.title-on-primary {
		margin: 0;
	}
	.additional {
		flex-direction: row;
		gap: size(4);
		justify-content: center;
		svg {
			width: size(8);
			fill: on-primary(1);
		}
	}
	nav {
		position: absolute;
		z-index: 20;
		top: 100%;
		left: 0;
		width: 100%;
		height: 100vh;
		display: flex;
		flex-direction: column;
		gap: size(8);
		opacity: 0;
		transition: opacity 200ms;
		padding: size(8) size(4);
		background-color: primary(5, 0.8);
		backdrop-filter: blur(0.4em);
		pointer-events: none;

		ul {
			display: flex;
			flex-direction: column;
			gap: size(4) size(8);
		}
	}
	a {
		display: block;
		position: relative;
		width: max-content;
		&::after {
			background-color: on-primary(2);
			@include pseudo;
			height: 2px;
			width: 0;
			transition: width 200ms;
		}
		&:hover::after,
		&:focus::after {
			width: 100%;
		}
	}
	// -- end region: all styling

	// -- start region: mobile

	.close-btn {
		display: none;
	}
	#hamburger-toggle:checked {
		& ~ nav {
			opacity: 1;
			pointer-events: all;
		}
		& ~ label {
			.close-btn {
				display: flex;
			}
			.open-btn {
				display: none;
			}
		}
	}
	// -- end region mobile

	// --start region desktop
	@media (min-width: 780px) {
		header {
			display: grid;
			grid-template-columns: 1fr 2fr;
			grid-template-areas: 'title nav nav';
		}
		label[for='hamburger-toggle'] {
			display: none;
		}
		nav {
			grid-area: nav;
			position: static;
			opacity: 1;
			pointer-events: all;
			height: max-content;
			flex-direction: row;
			justify-content: space-between;
			padding: 0;
			ul {
				flex-direction: row;
				align-items: center;
			}
		}
	}
	//--end region desktop
</style>
