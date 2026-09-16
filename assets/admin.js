import { registerReactControllerComponents } from '@symfony/ux-react';
import './bootstrap.js';


import './styles/admin.css' 


registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));