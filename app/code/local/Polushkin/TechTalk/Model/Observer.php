<?php

class Polushkin_TechTalk_Model_Observer
{
    public function addStatus($event)
    {
        $statuses = $event->getData('statuses')->getData();
        $statuses[] = 'Force Enabled';
        $event->getData('statuses')->setData($statuses);
    }
}