<?php

/**
 * LICENSE: The MIT License (the "License")
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * https://github.com/azure/azure-storage-php/LICENSE
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * PHP version 5
 *
 * @category  Microsoft
 * @package   MicrosoftAzure\Storage\Queue\Models
 * @author    Azure Storage PHP SDK <dmsh@microsoft.com>
 * @copyright 2016 Microsoft Corporation
 * @license   https://github.com/azure/azure-storage-php/LICENSE
 * @link      https://github.com/azure/azure-storage-php
 */
 
namespace MicrosoftAzure\Storage\Queue\Models;

use MicrosoftAzure\Storage\Common\Internal\Utilities;

/**
 * Holds data for single WindowsAzure queue message.
 *
 * @category  Microsoft
 * @package   MicrosoftAzure\Storage\Queue\Models
 * @author    Azure Storage PHP SDK <dmsh@microsoft.com>
 * @copyright 2016 Microsoft Corporation
 * @license   https://github.com/azure/azure-storage-php/LICENSE
 * @link      https://github.com/azure/azure-storage-php
 */
class MicrosoftAzureQueueMessage
{
    private $_messageId;
    private $_insertionDate;
    private $_expirationDate;
    private $_popReceipt;
    private $_timeNextVisible;
    private $_dequeueCount;
    private $_messageText;
    
    /**
     * Creates MicrosoftAzureQueueMessage object from parsed XML response of
     * ListMessages.
     *
     * @param array $parsedResponse XML response parsed into array.
     *
     * @internal
     *
     * @return MicrosoftAzureQueueMessage
     */
    public static function createFromListMessages(array $parsedResponse)
    {
        $timeNextVisible = $parsedResponse['TimeNextVisible'];
        
        $msg  = self::createFromPeekMessages($parsedResponse);
        $date = Utilities::rfc1123ToDateTime($timeNextVisible);
        $msg->setTimeNextVisible($date);
        $msg->setPopReceipt($parsedResponse['PopReceipt']);
        
        return $msg;
    }
    
    /**
     * Creates MicrosoftAzureQueueMessage object from parsed XML response of
     * PeekMessages.
     *
     * @param array $parsedResponse XML response parsed into array.
     *
     * @internal
     *
     * @return MicrosoftAzureQueueMessage
     */
    public static function createFromPeekMessages(array $parsedResponse)
    {
        $msg            = new MicrosoftAzureQueueMessage();
        $expirationDate = $parsedResponse['ExpirationTime'];
        $insertionDate  = $parsedResponse['InsertionTime'];
        
        $msg->setDequeueCount(intval($parsedResponse['DequeueCount']));
        
        $date = Utilities::rfc1123ToDateTime($expirationDate);
        $msg->setExpirationDate($date);
        
        $date = Utilities::rfc1123ToDateTime($insertionDate);
        $msg->setInsertionDate($date);
        
        $msg->setMessageId($parsedResponse['MessageId']);
        $msg->setMessageText($parsedResponse['MessageText']);
        
        return $msg;
    }
    
    /**
     * Gets message text field.
     *
     * @return string
     */
    public function getMessageText()
    {
        return $this->_messageText;
    }
    
    /**
     * Sets message text field.
     *
     * @param string $messageText message contents.
     *
     * @return void
     */
    public function setMessageText($messageText)
    {
        $this->_messageText = $messageText;
    }
    
    /**
     * Gets messageId field.
     *
     * @return integer
     */
    public function getMessageId()
    {
        return $this->_messageId;
    }
    
    /**
     * Sets messageId field.
     *
     * @param string $messageId message contents.
     *
     * @return void
     */
    public function setMessageId($messageId)
    {
        $this->_messageId = $messageId;
    }
    
    /**
     * Gets insertionDate field.
     *
     * @return \DateTime
     */
    public function getInsertionDate()
    {
        return $this->_insertionDate;
    }
    
    /**
     * Sets insertionDate field.
     *
     * @param \DateTime $insertionDate message contents.
     *
     * @internal
     *
     * @return void
     */
    public function setInsertionDate(\DateTime $insertionDate)
    {
        $this->_insertionDate = $insertionDate;
    }
    
    /**
     * Gets expirationDate field.
     *
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->_expirationDate;
    }
    
    /**
     * Sets expirationDate field.
     *
     * @param \DateTime $expirationDate the expiration date of the message.
     *
     * @return void
     */
    public function setExpirationDate(\DateTime $expirationDate)
    {
        $this->_expirationDate = $expirationDate;
    }
    
    /**
     * Gets timeNextVisible field.
     *
     * @return \DateTime
     */
    public function getTimeNextVisible()
    {
        return $this->_timeNextVisible;
    }
    
    /**
     * Sets timeNextVisible field.
     *
     * @param \DateTime $timeNextVisible next visibile time for the message.
     *
     * @return void
     */
    public function setTimeNextVisible($timeNextVisible)
    {
        $this->_timeNextVisible = $timeNextVisible;
    }
    
    /**
     * Gets popReceipt field.
     *
     * @return string
     */
    public function getPopReceipt()
    {
        return $this->_popReceipt;
    }
    
    /**
     * Sets popReceipt field.
     *
     * @param string $popReceipt used when deleting the message.
     *
     * @return void
     */
    public function setPopReceipt($popReceipt)
    {
        $this->_popReceipt = $popReceipt;
    }
    
    /**
     * Gets dequeueCount field.
     *
     * @return integer
     */
    public function getDequeueCount()
    {
        return $this->_dequeueCount;
    }
    
    /**
     * Sets dequeueCount field.
     *
     * @param integer $dequeueCount number of dequeues for that message.
     *
     * @internal
     *
     * @return void
     */
    public function setDequeueCount($dequeueCount)
    {
        $this->_dequeueCount = $dequeueCount;
    }
}
