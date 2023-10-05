import { env } from '$env/dynamic/public';

import axiosImport from 'axios';

export const axios = axiosImport.create({
	baseURL: env.PUBLIC_API_URL,
	timeout: 2000,
	headers: { 'X-Requested-With': 'XMLHttpRequest', Accept: 'application/json' },
	withCredentials: true
});
