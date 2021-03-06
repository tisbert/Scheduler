<?php
namespace Craft;

/**
 * Scheduler by Supercool
 *
 * @package   Scheduler
 * @author    Josh Angell
 * @copyright Copyright (c) 2017, Supercool Ltd
 * @link      https://github.com/supercool/Scheduler
 */

class Scheduler_JobModel extends BaseComponentModel
{

	// Properties
	// =========================================================================

	/**
	 * @var
	 */
	private $_jobType;


	// Public Methods
	// =========================================================================

	public function __toString()
	{
		return Craft::t($this->id);
	}

	/**
	 * Returns the Job type this Job is using.
	 *
	 * @return BaseScheduler_Job|null
	 */
	public function getJobType()
	{
		if (!isset($this->_jobType))
		{

			$component = Craft::createComponent("Craft\\".$this->type);

			if ($component)
			{
				$component->model = $this;
			}

			$this->_jobType = $component;

			// Might not actually exist
			if (!$this->_jobType)
			{
				$this->_jobType = false;
			}
		}

		// Return 'null' instead of 'false' if it doesn't exist
		if ($this->_jobType)
		{
			return $this->_jobType;
		}
	}

	// Protected Methods
	// =========================================================================

	/**
	 * Defines this model's attributes.
	 *
	 * @return array
	 */
	protected function defineAttributes()
	{
		return array(
			'id'       => AttributeType::Number,
			'type'     => AttributeType::String,
			'date'     => AttributeType::DateTime,
			'context'  => AttributeType::String,
			'settings' => AttributeType::Mixed,
		);
	}

}
