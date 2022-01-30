<script type="text/javascript" async="" src="https://cdn.eksiup.com/api/interstitial/sahinterstitial.js"></script>
<script src="http://is.cdn.md/i4/Js/LiveUpdater.js?v=2.7.61" type="text/javascript"></script>
<script>
    
    getMatches();
        var poll = new KokteylPoll.poll(Sahadan.LiveEvents.getEventDataCompleted, Sahadan.LiveEvents.errorHandler);
        var iLastMessageId = 0;
        var iMessageCount = 0;
        var iForumStarted = false;
        var forumPoll;

        function suspendForum() {
            forumPoll.abort();
            iForumStarted = false;
        }
        function startForum() {
            if (!iForumStarted) {
                forumPoll = new KokteylPoll.pollForum("live", successFn, null, iLastMessageId);
                iForumStarted = true;
            }
        }

        getForumMessages = function () {
            $.ajax({
                dataType: "json",
                url: "http://arsiv.sahadan.com/AjaxHandlers/ForumHandler.aspx?fId=live&mId=" + iLastMessageId,
                success: function (data) {
                    if (data) {
                        successFn(data.m, data.d);
                    }
                },
                error: function () {
                    forumTimeOut = setTimeout(getForumMessages, 2000);
                }
            });
        };

        forumStartStop = function (obj) {
            if (obj.checked) {
                startForum();
            } else {
                suspendForum();
            }
        };

        var successFn = function (messages, deleted, subs) {
            for (var i = 0; i < messages.length; i++) {
                var message = messages[i];
                iMessageCount++;
                if (message.id <= iLastMessageId || message.adm) {
                    continue;
                }
                var strMessage = "<tr id=\"msg_" + message.id + "\" class=\"row" + (iMessageCount % 2 + 1) + "\">";
                strMessage += "<td width=\"30%\"><a target=\"_blank\" href=\"http://www.mackolik.com/ForumDetails/Default.aspx?id=" + message.fId + "\">" + message.forum + "</a></td>";
                //strMessage += "<td width=\"19%\"><span class=\"fnt-bld\">" + message.nick + "</b> - " + message.ref + "</span><br/><span class=\"gray\">" + message.date + "</span></td>";
                strMessage += "<td width=\"70%\" style=\"white-space:normal;" + (message.adm ? "color:#CC2222 !important" : "") + "\" align=\"left\" valign=top>" + message.msg + "</td></tr>";
                $("#dvForumMessages").prepend(strMessage);

                $("#msg_" + message.id).effect("highlight", {}, 3000);
            }
            if (deleted.length > 0) {
                for (var i = 0; i < deleted.length; i++) {
                    if ($("#msg_" + deleted[i]).length > 0) {
                        $("#msg_" + deleted[i]).remove();
                    }
                }
                $("#dvForumMessages tr").removeClass("row1 row2").each(function (index, element) {
                    $(element).addClass("row" + (index % 2 + 1));
                });
            }
            if (messages.length > 0) {
                iLastMessageId = messages[messages.length - 1].id;
            }
            $('#dvForumMessages tr:gt(10)').remove();
        };
        // getForumMessages();
    
</script>
<section class="container">
    
</section>