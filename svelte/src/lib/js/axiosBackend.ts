import axios, { type AxiosInstance } from 'axios';
import { env } from '$env/dynamic/public';

export const axiosBackend: AxiosInstance = axios.create({
	baseURL: env.PUBLIC_API_URL as string,
	headers: {
		'X-Requested-With': 'XMLHttpRequest'
	},
	withCredentials: true // required to handle the CSRF token
});
