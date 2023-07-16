import { registerReactControllerComponents } from '@symfony/ux-react';
import './bootstrap.js';


import './styles/admin.scss';
import DataTable from 'datatables.net-dt';

let table = new DataTable('#table', {
    responsive: true,
    "paging": true,
    "ordering": true,
    "searching": true,
});

registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));