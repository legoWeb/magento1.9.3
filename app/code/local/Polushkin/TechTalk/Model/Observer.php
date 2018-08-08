<?php

class Polushkin_TechTalk_Model_Observer
{
    public function addStatus($event)
    {
        $statuses = $event->getData('statuses')->getData();
        $statuses[] = 'Force Enabled';
        $event->getData('statuses')->setData($statuses);
    }
    public function addText($event)
    {
//        $newtext = $event->getData('form')->getData('_elements');
//        $newtext[] = 'Made in China';
//        $event->getData('form')->setForm($newtext);

        $newtext = $event->getData('event')->getData('data_object')->getContent();
        $newtext[] = 'Made in China';
        $event->getData('event')->getData('data_object')->setData('content', $newtext);
    }
}