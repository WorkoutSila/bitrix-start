/**
 * TaskManager Application
 *
 * @package demo
 * @subpackage local
 * @copyright 2001-2022 Bitrix
 */

import {BitrixVue} from 'ui.vue3';
import {Dom, Loc} from 'main.core';
import {TaskManager} from './component/task-manager';

export class TaskManager
{
	#application;

	constructor(rootNode)
	{
		this.rootNode = document.querySelector(rootNode);
	}

	start()
	{
		this.attachTemplate()
		const button = Dom.create('button', {
			text: Loc.getMessage('TASK_MANAGER_OPEN'),
			events: {
				// click: () => this.attachTemplate()
			},
		});
		Dom.append(button, this.rootNode);
	}

	attachTemplate()
	{
		const context = this;
		this.#application = BitrixVue.createApp({
			name: 'TaskManager',
			components: {
				TaskManager
			},
			beforeCreate()
			{
				this.$bitrix.Application.set(context);
			},
			template: '<TaskManager/>'
		});
		this.#application.mount(this.rootNode)
	}

	detachTemplate()
	{
		if (this.#application)
		{
			this.#application.unmount();
		}

		this.start();
	}
}
