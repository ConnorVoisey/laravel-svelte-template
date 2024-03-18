import { components } from './lib/js/openApiSchema';
/// <reference types="@sveltejs/kit" />

// See https://kit.svelte.dev/docs#typescript
// for information about these interfaces
declare global {
	namespace App {
		interface Locals {
			user: User?;
		}

		interface PageData {
			user: User?;
		}

		// interface Platform {}

		// interface Session {}

		// interface Stuff {}
		type User = components['schemas']['Profile Schema'];
	}
}

export {};
